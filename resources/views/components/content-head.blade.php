    <!-- begin:: Content Head -->
    <div class="subheader py-2 py-lg-4  subheader-solid" id="kt_subheader">
        <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h4 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{ $title ?? '' }}</h4>
                <span class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></span>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    @foreach ($breadcrumb as $bc)
                        <li class="breadcrumb-item">
                            <a href="{{ empty($bc['route']) ? 'javascript:;' : route($bc['route']) }}" class="text-muted">{{ $bc['label'] }}</a>
                            @if(!isset($bc['isLast']))
                                <span class="subheader-separator"></span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <!-- end:: Content Head -->
