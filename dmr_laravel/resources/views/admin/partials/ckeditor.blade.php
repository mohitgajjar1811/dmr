@push('scripts')
    <!-- CKEditor 4 Standard-All (Highly stable with native Source Editing) -->
    <script src="https://cdn.ckeditor.com/4.22.1/standard-all/ckeditor.js"></script>
    <script>
        (function() {
            function initCKEditor4() {
                if (typeof CKEDITOR === 'undefined') {
                    setTimeout(initCKEditor4, 100);
                    return;
                }

                document.querySelectorAll('.rich-editor').forEach(el => {
                    if (el.getAttribute('data-ckeditor-initialized')) return;
                    
                    const editorId = el.id || 'editor-' + Math.random().toString(36).substr(2, 9);
                    if (!el.id) el.id = editorId;

                    CKEDITOR.replace(el.id, {
                        extraPlugins: 'sourcedialog,justify,colorbutton,font',
                        toolbar: [
                            { name: 'document', items: ['Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates'] },
                            { name: 'clipboard', items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'] },
                            { name: 'editing', items: ['Find', 'Replace', '-', 'SelectAll'] },
                            '/',
                            { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat'] },
                            { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
                            { name: 'links', items: ['Link', 'Unlink', 'Anchor'] },
                            { name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'SpecialChar', 'PageBreak'] },
                            '/',
                            { name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize'] },
                            { name: 'colors', items: ['TextColor', 'BGColor'] },
                            { name: 'tools', items: ['Maximize', 'ShowBlocks'] }
                        ],
                        height: 350,
                        // Upload configuration
                        filebrowserImageUploadUrl: '{{ route('admin.upload.image') }}?_token={{ csrf_token() }}&type=Images',
                        // Styles
                        contentsCss: [
                            'https://cdn.ckeditor.com/4.22.1/standard-all/contents.css'
                        ],
                        // Ensure all HTML is allowed for Source editing
                        allowedContent: true,
                        removeButtons: 'About',
                        // Design
                        uiColor: '#F8FAFC',
                    });

                    el.setAttribute('data-ckeditor-initialized', 'true');
                });
            }

            initCKEditor4();
            window.addEventListener('load', initCKEditor4);
        })();
    </script>
    <style>
        /* Premium Admin UI Styling for CKEditor 4 */
        .cke_chrome {
            border: 1px solid #e5e7eb !important;
            border-radius: 12px !important;
            box-shadow: none !important;
            overflow: hidden !important;
        }

        .cke_top {
            background: #f9fafb !important;
            border-bottom: 1px solid #e5e7eb !important;
            padding: 0.5rem !important;
        }

        .cke_bottom {
            background: #f9fafb !important;
            border-top: 1px solid #e5e7eb !important;
        }

        .cke_button:hover {
            background-color: #fee2e2 !important;
            border-radius: 4px !important;
        }
        
        .cke_button_on {
            background-color: #ef4444 !important;
            color: white !important;
            border-radius: 4px !important;
        }

        .cke_button_icon {
            filter: none !important;
        }
    </style>
@endpush
