document.addEventListener('alpine:init', () => {
    Alpine.data('cropper', (r = 1, m = 0) => ({
        open: false,
        dontOpen: true,
        file: null,
        input: null,
        cropperInstance: null,
        ratio: parseFloat(r),
        mode: parseInt(m),

        init() {
            this.$el.addEventListener('file-uploaded', (event) => {
                const reader = new FileReader();
                reader.onload = (e) => {
                    if (this.cropperInstance) this.cropperInstance.destroy();

                    const imageElement = this.$refs.cropperImage;
                    imageElement.src = e.target.result;
                    imageElement.addEventListener('load', this.initCropper);

                    setTimeout(() => {
                        this.cropperInstance = new Cropper(imageElement, {
                            responsive: true,
                            aspectRatio: this.ratio,
                            mode: this.mode
                        });
                    }, 500);
                    this.toggleModal();
                };
                reader.readAsDataURL(this.file);
            });
        },

        initCropper() {
            const imageElement = this.$refs.cropperImage;
            this.cropperInstance = new Cropper(imageElement, {
                responsive: true,
                aspectRatio: this.ratio,
                mode: this.mode
            });
            this.toggleModal();
            imageElement.removeEventListener('load', this.initCropper);
        },

        handleFileChange(e) {
            if(this.dontOpen) {
                this.file = e.target.files[0];
                this.input = e.target;
                const t = this;
                if (!this.file) return;
                const reader = new FileReader();
                this.$dispatch('file-uploaded', { file: this.file });
                this.dontOpen = false;
            }
        },

        cropImage() {
            const croppedCanvas = this.cropperInstance.getCroppedCanvas();
            if (!croppedCanvas) {
                alert('Error: Failed to get cropped image.');
                return;
            }
            croppedCanvas.toBlob((blob) => {
                if (!blob) {
                    alert('Error: Failed to convert image.');
                    return;
                }
                const mimeType = blob.type;
                const fileName = `cropped-image-${Date.now()}.${mimeType.split('/')[1]}`;
                const croppedFile = new File([blob], fileName, { type: mimeType });
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(croppedFile);
                if (this.input) {
                    this.input.files = dataTransfer.files;
                    this.input.dispatchEvent(new Event('change'));
                    this.dontOpen = true;
                }
                this.toggleModal();
            });
        },

        toggleModal() {
            this.open = !this.open;
        },

        closeModal() {
            this.dontOpen = true;
            this.open = false;
        }
    }));
});