<script>
    toastr.options = {
        closeButton: true,
        newestOnTop: true,
        progressBar: true,
        positionClass: 'toast-bottom-right',
        preventDuplicates: true,
    };

    function bindDeleteButton(datatable, route, model, reload = false) {
        toastr.options = {
            closeButton: true,
            newestOnTop: true,
            progressBar: true,
            positionClass: 'toast-bottom-right',
            preventDuplicates: true,
        };

        datatable.on('click', 'a.row-delete', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            var row = $(this).parents('tr');
            var newRoute = route.replace('@@@', id);

            swal.fire({
                title: "@lang('ttdt.confirmation.delete_row.title')",
                text: "@lang('ttdt.confirmation.delete_row.message')",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "@lang('ttdt.confirmation.button.confirm')",
                cancelButtonText: "@lang('ttdt.confirmation.button.cancel')",
            }).then((result) => {
                if (result.value) {
                    axios.delete(newRoute)
                        .then(function (response) {
                            if (reload) {
                                swal.fire({
                                    title: ` ID # ${id}  @lang('ttdt.message.success.deleted')`,
                                    icon: 'success',
                                    timer: 2000,
                                    timerProgressBar: true,
                                }).then((result) => {
                                    window.location.reload();
                                });
                            } else {
                                if (response.data.success) {
                                    datatable.reload();
                                    toastr.success(model.charAt(0).toUpperCase() + model.slice(1) + ` ID # ${id}  @lang('ttdt.message.success.deleted')`);
                                } else {
                                    var errorMessage = response.data.message ? response.data.message : `@lang('ttdt.message.error.deleted_fail') ${model} ID # ${id} !`;

                                    toastr.error(errorMessage);
                                }
                            }
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                }
            })
        });
    }

    function initKTDatatable(datatableSelector, ajaxUrl, columns, searchBoxSelector, scroll = false, height = 0, childTableFunction = null) {
        let options = {
            data: {
                type: 'remote',
                source: {
                    read: {
                        url: ajaxUrl,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
                        },
                        map: function (raw) {
                            var dataSet = raw;
                            if (typeof raw.data !== 'undefined') {
                                dataSet = raw.data;
                            }
                            return dataSet;
                        },
                    },
                },
                pageSize: 10,
                serverPaging: !0,
                serverFiltering: !0,
                serverSorting: !0,
                autoColumns: false
            },
            layout: {
                scroll: scroll,
                footer: false,
                icons: {
                    rowDetail: {
                        expand: 'la la-caret-down',
                        collapse: 'la la-caret-right'
                    }
                },
                customScrollbar: false,
            },
            sortable: true,
            pagination: true,
            toolbar: {
                layout: ['pagination', 'info'],
                placement: ['bottom'],
                items: {
                    pagination: {
                        pageSizeSelect: [5, 10, 20, 30, 50, 100],
                        navigation: {
                            prev: true,
                            next: true,
                            first: true,
                            last: true
                        },
                    },
                    info: true
                },
            },
            search: {
                input: $(searchBoxSelector),
                delay: 500,
            },
            rows: {
                autoHide: false
            },
            columns: columns,
        }

        if (childTableFunction != null) {
            options.detail = {
                title: 'Load sub table',
                content: childTableFunction
            };
        } else {
            if (height > 0) {
                options.layout.height = height;
            }
        }

        let datatable = $(datatableSelector).KTDatatable(options);

        $(datatableSelector).on('kt-datatable--on-layout-updated', function (event) {
            KTApp.initPopovers();
            KTApp.initTooltips();
        });

        $(datatableSelector).on('kt-datatable--on-ajax-done', function (event, data) {
            $('#total').show().find('span').text(data.length);
        });

        return datatable;
    }

    function formatDate(ymdDate) {
        return ymdDate && ymdDate != '1970-01-01' ? `<span style="font-family: 'Roboto Mono';font-weight: 400;">` + moment(ymdDate, 'YYYY-MM-DD').format('DD/MM/YYYY') + `</span>` : '';
    }

    function formatDateTime(ymdDateTime) {
        return ymdDateTime ? `<span style="font-family: 'Roboto Mono';font-weight: 400;">` + moment(ymdDateTime, 'YYYY-MM-DD HH:mm:ss').format('DD/MM/YYYY HH:mm:ss') + `</span>` : '';
    }

    function formatTime(time) {
        return time ? moment(time, 'HH:mm:ss').format('HH:mm') : '';
    }

    function strip(html) {
        var tmp = document.createElement("DIV");
        tmp.innerHTML = html;
        return tmp.textContent.replace(/"/g, "'") || tmp.innerText.replace(/"/g, "'") || "";
    }

    function moneyFormat(number) {
        if (!$.isNumeric(number)) {
            number = 0;
        }

        var moneyFormat = wNumb({
            mark: '.',
            thousand: ',',
            decimals: 2
        });

        return moneyFormat.to(number)
    }

    function numberFormat(number) {
        if (!$.isNumeric(number)) {
            number = 0;
        }

        var numberFormat = wNumb({
            mark: '.',
            thousand: ',',
        });

        return numberFormat.to(number);
    }

    //dd/mm/yyyy e.g 28/02/2020
    function isDateVN(dateString) {
        var dateRegex = /^([0-2][0-9]|(3)[0-1])(\/)(((0)[0-9])|((1)[0-2]))(\/)\d{4}$/;

        return dateRegex.test(dateString);
    }

    function showElementFollowParent(parent, children) {
        let parentElement = $(`#${parent}`);
        let childrenElement = $(`#${children}`);
        let parentElementValue = $(`input[name="${parent}"]:checked`, `#${parent}`).val();

        toggleElement(childrenElement, parentElementValue)
        parentElement.change(() => {
            toggleElement(childrenElement, parentElementValue)
        });
    }

    function toggleElement(Element, check) {
        if (check === '1') {
            Element.show()
        } else {
            Element.hide()
        }
    }

    function initSelect2(url, element) {
        $(`#${element}`).select2({
            placeholder: "@lang('ttdt.search')",
            allowClear: true,
            ajax: {
                url: url,
                dataType: 'json',
                delay: 100,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
                },
                data: function (params) {
                    return {
                        search: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function (data, params) {
                    params.page = params.page || 1;
                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page * 10) < data.total_count
                        }
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) {
                return markup;
            },
            minimumInputLength: 1,
            templateResult: formatRepo,
            templateSelection: formatRepoSelection
        });
    }

    function formatRepo(repo) {
        if (repo.loading) return repo.text;
        let name = '';
        if(repo.name) name = repo.name;
        else if(repo.email) name = repo.email;
        else if(repo.user) name = repo.user.email;
        var markup = "<div class='select2-result-repository clearfix'>" +
            "<div class='select2-result-repository__meta'>" +
            "<div class='select2-result-repository__title'>" + name + "</div>";

        return markup;
    }

    function formatRepoSelection(repo) {
        if(repo.name) return repo.name;
        else if(repo.email) return repo.email;
        else if(repo.user) return repo.user.email;
        else return repo.text;
    }


    function handleDeleteButton(element, route, model, reload = false, parentElement = '.card') {
        toastr.options = {
            closeButton: true,
            newestOnTop: true,
            progressBar: true,
            positionClass: 'toast-bottom-right',
            preventDuplicates: true,
        };

        $(element).on('click', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            var self = $(this);
            var newRoute = route.replace('@@@', id);

            swal.fire({
                title: "@lang('ttdt.confirmation.delete_row.title')",
                text: "@lang('ttdt.confirmation.delete_row.message')",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "@lang('ttdt.confirmation.button.confirm')",
                cancelButtonText: "@lang('ttdt.confirmation.button.cancel')",
            }).then((result) => {
                if (result.value) {
                    axios.delete(newRoute)
                        .then(function (response) {
                            if (response.data.success) {
                                self.parents(parentElement).remove();
                                toastr.success(model.charAt(0).toUpperCase() + model.slice(1) + ` ID # ${id}  @lang('ttdt.message.success.deleted')`);
                            } else {
                                var errorMessage = response.data.message ? response.data.message : `@lang('ttdt.message.error.deleted_fail') ${model} ID # ${id} !`;
                                toastr.error(errorMessage);
                            }
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                }
            })
        });
    }

    $(document).ready(function () {
        autosize($('textarea'));
    })
</script>
