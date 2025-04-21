<template>
    <div ref="flipbook" class="flipbook-container"></div>
</template>
<script>
import $ from 'jquery';
// turn.js para efecto flipbook
import 'turn.js';
// Importa la build UMD/CommonJS de PDF.js y el worker JS transpileado
import pdfjsLib from 'pdfjs-dist/build/pdf.js';
import pdfjsWorker from 'pdfjs-dist/build/pdf.worker.js';

// Configura el worker para PDF.js
pdfjsLib.GlobalWorkerOptions.workerSrc = pdfjsWorker;

export default {
  name: 'FlipBook',
  props: {
    pdfUrl: { type: String, required: true }
  },
  mounted() {
    const el = this.$refs.flipbook;
    // Inicializa el contenedor flipbook
    $(el).turn({
      width: 800,
      height: 600,
      autoCenter: true,
      pages: 0
    });

    // Carga el PDF y renderiza cada página
    pdfjsLib.getDocument(this.pdfUrl).promise.then(pdf => {
      const total = pdf.numPages;
      $(el).turn('pages', total);
      for (let i = 1; i <= total; i++) {
        pdf.getPage(i).then(page => {
          const viewport = page.getViewport({ scale: 1 });
          const canvas = document.createElement('canvas');
          const ctx = canvas.getContext('2d');
          canvas.width = viewport.width;
          canvas.height = viewport.height;
          page.render({ canvasContext: ctx, viewport }).promise.then(() => {
            const pageWrapper = document.createElement('div');
            pageWrapper.className = 'page';
            pageWrapper.appendChild(canvas);
            // Añade la página al flipbook
            $(el).turn('addPage', pageWrapper, i);
          });
        });
      }
    }).catch(err => {
      console.error('Error loading PDF:', err);
    });
  }
};
</script>
<style scoped>
.flipbook-container {
  width: 800px;
  height: 600px;
  margin: auto;
}
.page canvas {
  display: block;
  width: 100%;
  height: 100%;
}
</style>