<x-moonshine::layout.div x-data="cropper({{ $ratio ?? 0 }}, {{ $mode ?? 1 }})">

    <small class="cropper-small">{{ __('moonshine-cropper::field.Upload image from your computer:') }}</small>

    <x-moonshine::form.file
            :attributes="$attributes"
            :files="$files"
            :removable="$isRemovable"
            :removableAttributes="$removableAttributes"
            :hiddenAttributes="$hiddenAttributes"
            :imageable="true"
            @change="handleFileChange($event)"
    />

    <div @defineEvent('modal-toggled', 'modal-cropper', 'toggleModal') >
    <div
            class="modal"
            x-show="open"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 -translate-y-10"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-10"
            aria-modal="true"
            role="dialog"
    >
        <div class="modal-dialog modal-dialog-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('moonshine-cropper::field.Change image') }}</h5>
                    <button type="button"
                            class="btn btn-close"
                            @click.stop="closeModal"
                            aria-label="Close"
                    >
                        <x-moonshine::icon icon="x-mark" size="6"/>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="cropper-wrapper">
                        <img x-ref="cropperImage">
                    </div>
                </div>
                <div class="modal-header">
                    <x-moonshine::link-button @click.prevent="closeModal" class="btn-secondary">
                        {{ __('moonshine-cropper::field.Close') }}
                    </x-moonshine::link-button>
                    <a class="btn btn-primary"
                       data-fieldName="{{ $attributes['name'] }}"
                       @click.prevent="cropImage"
                    >
                        {{ __('moonshine-cropper::field.Crop') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div x-show="open" x-transition.opacity class="modal-backdrop"></div>

    </div>

</x-moonshine::layout.div>