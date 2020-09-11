<div class="subheader py-2 py-lg-4  subheader-solid" id="kt_subheader">
    <div class="container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-2">
            <h3 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{ $title ?? '' }}</h3>
            <span class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></span>
            <div class="d-flex align-items-center" id="kt_subheader_search">
                <div class="margin-l-20 margin-r-40 flex-grow-1" id="kt_subheader_search_form">
                    <div class="input-group input-group-sm input-group-solid">
                        <input type="text" class="form-control" placeholder="@lang('ttdt.search')......." id="generalSearch">
                        <div class="input-group-append">
                            <span class="input-group-text">
                               <i class="flaticon2-search-1"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="subheader__toolbar">
            <a href="{{ $createRoute ? route($createRoute) : 'javacript:;' }}" class="btn btn-light-facebook font-weight-bolder">
                <i class="flaticon2-add-1"></i>
                {{ $createButtonLabel ?? '' }}
            </a>
            @if (isset($importRoute))
                <button type="button" class="btn btn-bold btn-label-brand" data-toggle="modal" data-target="#kt_modal_5">
                    <i class="la la-file-excel-o"></i>
                        Nhập từ file excel
                </button>

                @push('modals')
                    <div class="modal fade" id="kt_modal_5" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true"
                        data-backdrop="static" data-keyboard="false">
                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tải file excel {{ $title ?? '' }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="{{ route($importRoute) }}"
                                          enctype="multipart/form-data" class="dropzone" id="my-dropzone">
                                        {{ csrf_field() }}
                                    </form>
                                    <div id="preview" style="display: none;">
                                    </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                @endpush

                @push('scripts')
                    <script>
                        Dropzone.autoDiscover = true;
                        Dropzone.options.myDropzone = {
                            maxFilesize: 20,
                            acceptedFiles: '.xls,.xlsx,.csv',
                            addedfile: function(file) {
                                console.log(file);
                            },
                            success: function (file, done) {
                                console.log(file);
                                if (done.success === true) {
                                    window.location.reload();
                                }
                            }
                        };
                    </script>

                @endpush
            @endif
        </div>
    </div>
</div>
