<script>
    // Finestra anteprima immagini
    document.addEventListener("DOMContentLoaded", function() {
        const coverInput = document.getElementById("image");
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
