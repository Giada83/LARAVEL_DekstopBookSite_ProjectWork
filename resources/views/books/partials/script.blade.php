 <!-- jQuery -->
 <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

 <script>
     $(document).ready(function() {
         // Imposta l'anno massimo per il campo year 
         const currentYear = new Date().getFullYear();
         document.getElementById('year').setAttribute('max', currentYear);

         //Select2 JS
         $('.select2').select2({
             placeholder: "Select an author",
             allowClear: true
         });

         //selezione multipla categorie
         $('#categories').select2({
             placeholder: 'Select categories',
             closeOnSelect: false // Opzionale: per mantenere aperta la select2 dopo ogni selezione
         });
     });

     // Finestra anteprima immagini
     document.addEventListener("DOMContentLoaded", function() {
         const coverInput = document.getElementById("cover");
         const previewContainer = document.getElementById("preview-container");
         const coverPreview = document.getElementById("cover-preview");
         const removeBtn = document.getElementById("remove-btn");

         coverInput.addEventListener("change", function() {
             const file = this.files[0];
             if (file) {
                 const reader = new FileReader();
                 reader.onload = function(e) {
                     coverPreview.src = e.target.result;
                     previewContainer.style.display = "block";
                 }
                 reader.readAsDataURL(file);
             } else {
                 previewContainer.style.display = "none";
             }
         });

         removeBtn.addEventListener("click", function() {
             coverInput.value = "";
             coverPreview.src = "#";
             previewContainer.style.display = "none";
         });
     });
 </script>
