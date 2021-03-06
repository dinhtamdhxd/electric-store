$(document).ready(function () {
    $.widget.bridge('uibutton', $.ui.button);
    bsCustomFileInput.init();
    //CHECK ALL CHECKBOX
    $('#check-all').click(function (e) {
        let status = this.checked;
        $('#form-table').find(':checkbox').not($(this)).each(function () {
            this.checked = status;
        });
    });

    //CHANGE GROUP ACP
    $('#filter-group-acp').change(function (e) {
        let exceptParams = ['filter-group-acp'];
        let link = createLink(exceptParams) + '&filter-group-acp=' + $(this).val();
        window.location.href = link;

    });

    //BTN CLEAR CLICK
    $('#btn-clear-search').click(function (e) {
        e.preventDefault();
        let link = resetLink();
        window.location.href = link;
    });

    //BTN SEARCH CLICK
    $('#btn-search').click(function (e) {
        e.preventDefault();
        let filter_search = $('input[name=filter-search]').val();
        let filter_by = $('#filter-by').val();
        let exceptParams = ['filter-search', 'filter-by'];
        let link = createLink(exceptParams);
        link = link.replace(/&page=[^&]*/img, ''); 
        var url_filter_search   =   '';
        var url_filter_by       =   '';
        if(filter_search != ''){
            url_filter_search   =   '&filter-search=' + filter_search ;
            if(filter_by != 'all'){
                url_filter_by       =   '&filter-by=' + filter_by;
            }
        }
        window.location.href = link + url_filter_search + url_filter_by;
    });

    //BULK ACTION
    $('#bulk-apply').click(function (e) {
        var action = $('select[name=bulk_action]').val();
        if (action != 'default') {
            var link = window.location.href;
            link = link.replace(/action=[^&]*/img, 'action=' + action);
            if (action != 'multy_delete') {
                $('#form-table').attr('action', link).submit();
            } else {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#form-table').attr('action', link).submit();
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })
            }
        } else {
            $('select[name=bulk_action]').notify(
                "Choose bulk action please!", {
                position: "top left",
                className: "info",
                autoHideDelay: 2000
            });
        }
    });

    //COUNT CHECKBOX
    $('#form-table :checkbox').click(function (e) {
        let numberChecked = $('#form-table input:checkbox:checked').not($('#check-all')).length;
        if (numberChecked > 0) {
            $('#bulk-apply span').text(numberChecked).css('display', 'block');
        } else {
            $('#bulk-apply span').text('').css('display', 'none');
        }
    })

    //FORM ACTION
    $('.btn-save').click(function (e) {
        e.preventDefault();
        let link = this.href;
        $('#form-data').attr('action', link).submit();
    });

    //CHANGE ORDERING
    $('input[name=ordering]').change(function (e) {
        var column_change =   'ordering';
        var ordering = $(this).val();
        var id = $(this).closest("tr").attr('id');
        var url = window.location.href;
        url = url.replace(/action=[^&]*/img, 'action=changeInput');
        $.ajax({
            url: url,
            data: { id: id, ordering: ordering, column_change: column_change},
            type: 'POST',
            dataType: 'JSON',
            success: function (data) {
                $('td.modified-' + data.id).html(data.modified);
                $('td.' + data.name + '-' + data.id + '> div').notify(
                    data.name + " changged!", {
                    position: "top center",
                    className: "success",
                    autoHideDelay: 2000
                });
            }
        })
    });

    //CHANGE PRICE
    $(document).on('change', 'input[name=price]', function (e) {
        var column_change =   'price';
        var price = $(this).val();
        price   =   price.replaceAll(',', '');
        var id = $(this).closest("tr").attr('id');
        var url = window.location.href;
        url = url.replace(/action=[^&]*/img, 'action=changeInput');
        $.ajax({
            url: url,
            data: { id: id, price: price, column_change: column_change},
            type: 'POST',
            dataType: 'JSON',
            success: function (data) {
                $('td.modified-' + data.id).html(data.modified);
                $('td.price-'+data.id).html(data.price_tag);
                $('td.' + data.name + '-' + data.id + '> div').notify(
                    data.name + " changged!", {
                    position: "top center",
                    className: "success",
                    autoHideDelay: 2000
                });
               
                
            }
        })
    });

    //CHANGE SALEOFF
    $('input[name=sale_off]').change(function (e) {
        var column_change =   'sale_off';
        var sale_off = $(this).val();
        var id = $(this).closest("tr").attr('id');
        var url = window.location.href;
        url = url.replace(/action=[^&]*/img, 'action=changeInput');
        $.ajax({
            url: url,
            data: { id: id, sale_off: sale_off, column_change: column_change},
            type: 'POST',
            dataType: 'JSON',
            success: function (data) {
                $('td.modified-' + data.id).html(data.modified);
                $('td.' + data.name + '-' + data.id + '> div').notify(
                    data.name + " changged!", {
                    position: "top center",
                    className: "success",
                    autoHideDelay: 2000
                });
            }
        })
    });

    //CHANGE GROUPNAME
    $('select.group-name').change(function(e){
        var column_change =   'group_id';
        var id     =   $(this).closest('tr').attr('id');
        var group_id = $(this).val();
        var url = window.location.href;
        url = url.replace(/action=[^&]*/img, 'action=changeSelect');
        $.ajax({
            url: url,
            data: { id: id, group_id: group_id, column_change: column_change },
            type: 'POST',
            dataType: 'JSON',
            success: function (data) {
                $('td.modified-' + data.id).html(data.modified);
                $('#group-name-'+id).notify(
                    data.name + " changged!", {
                    position: "top center",
                    className: "success",
                    autoHideDelay: 2000
                });
            }
        })
    });

    //CHANGE GROUPCATEGORY
    $('select.group-category').change(function(e){
        var column_change =   'category_id';
        var id     =   $(this).closest('tr').attr('id');
        var category_id = $(this).val();
        var url = window.location.href;
        url = url.replace(/action=[^&]*/img, 'action=changeSelect');
        $.ajax({
            url: url,
            data: { id: id, category_id: category_id, column_change: column_change },
            type: 'POST',
            dataType: 'JSON',
            success: function (data) {
                $('td.modified-' + data.id).html(data.modified);
                $('#group-category-'+id).notify(
                    data.name + " changged!", {
                    position: "top center",
                    className: "success",
                    autoHideDelay: 2000
                });
            }
        })
    });

    //SEARCH GROUP NAME
    $('#filter-group-name').change(function (e) {
        let exceptParams = ['filter-group-name'];
        var link = createLink(exceptParams)
        if($(this).val() != 'default'){
            link +=  '&filter-group-name=' + $(this).val();
        }
        window.location.href = link;

    });

     //SEARCH GROUP CATEGORY
     $('#filter-group-category').change(function (e) {
        let exceptParams = ['filter-group-category'];
        var link = createLink(exceptParams)
        if($(this).val() != 'default'){
            link +=  '&filter-group-category=' + $(this).val();
        }
        window.location.href = link;

    });

    // EVENT FILE UPLOAD UP
    $('input[type=file]').change(function (e) {
        _this   =   $(this);
        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                imgUpdate = '<img class="img-thumbnail mt-2" src="'+e.target.result+'" style="width: ' + (IMG_SIZE.width +10) + 'px; height: ' + (IMG_SIZE.height +10) + 'px; margin-left: 120px;">';
                if(_this.closest('div').next().prop('tagName') == 'IMG') _this.closest('div').next().hide();
                _this.closest('div').after(imgUpdate);
            }

            reader.readAsDataURL(this.files[0]); // convert to base64 string
        }
    });

    //SHOW AND UPDATE PRIVILEGE
    $(document).on('click', '.span-icon-privilege', function(e){
        console.log(1);
        var id = $(this).closest('tr').attr('id');
        var value_privilege_id = $(this).closest('div').prev().val();
        var arrActive = value_privilege_id.split(",");
        var arrPrivilege = THEME_DATA.arrPrivilege_id;
        var contentConfirm = '';
        var dataSend = '';
        if (value_privilege_id == '') {
            contentConfirm  =   'Add privilege';
        } else {
            contentConfirm  =   'Update';
        }
        Swal.fire({
            title: 'Privilege of group',
            html: swalCreateHTML(arrPrivilege, arrActive),
            showCancelButton: true,
            confirmButtonText: contentConfirm,
            showLoaderOnConfirm: true,
            preConfirm: () => {
                newArrPrivilege_id  =   [];
                $("#form-privilege").find(':checkbox').each(function(){
                    if(this.checked == true){
                        newArrPrivilege_id.push(this.value);
                    };
                });
                
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            
            if (result.isConfirmed) {
                dataSend    =   {'id': id, 'arrPrivilege_id': newArrPrivilege_id};
                url =   'index.php?module='+THEME_DATA.module+'&controller='+THEME_DATA.controller+'&action=changePrivilege';
                $.ajax({
                    url: url,
                    data: dataSend, 
                    type: 'POST',
                    dataType: 'JSON',
                    success: function(data){
                        $('td.privilege_id-'+data.id).children('input').val(data.privilege_id);
                        $('td.modified_'+data.id).html(data.modified);
                        $('div.icon-privilege-'+data.id).html(data.icon);
                        Swal.fire({
                            position: 'top',
                            icon: 'success',
                            title: 'Change privilege successfull!',
                            showConfirmButton: false,
                            timer: 2000
                          });
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        Swal.fire({
                            position: 'top',
                            icon: 'warning',
                            title: 'Error' + xhr.status + thrownError,
                            showConfirmButton: false,
                            timer: 1500
                          });
                      }
                });
            }
        });
    })
  
    //INPUT FORM PRIVILEGE

    $('#input-privilege').click(function(e){
        var arrPrivilege = THEME_DATA.arrPrivilege_id;
        if($(this).val() == ''){
            arrActive   =   [0];
        }else{
            arrActive   =   $(this).val().split(',');
        }
        
        Swal.fire({
            title: 'Privilege of group',
            html: swalCreateFormHTML(arrPrivilege, arrActive),
            showCancelButton: true,
            confirmButtonText: 'Confirm',
            showLoaderOnConfirm: true,
            preConfirm: () => {
                newArrPrivilege_id  =   [];
                $("#form-privilege").find(':checkbox').each(function(){
                    if(this.checked == true){
                        newArrPrivilege_id.push(this.value);
                    };
                });
                privilege_str   =   newArrPrivilege_id.join(',');
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                $(this).val(privilege_str);
            }
        });
    })
});
 
//FUNCTION CREATE HTML FOR SWAL
function swalCreateHTML(arrPrivilege, arrActive){
    var xhtml = '';
    var notice = '';
    if(arrActive[0] == ''){
        var notice = '<p>Bạn chưa được cấp quyền!</p>';
    }
    xhtml = notice + '<form id="form-privilege"><ul class="list-group-sm">';
    for (let i = 1; i <= arrPrivilege.length; i++) {
        checked = (arrActive.includes(i.toString())) ? 'checked' : '';
        xhtml += '<li class="list-group-item text-left p-1 pl-2" style="height: 30px;">';
        xhtml += '<input type="checkbox" value="'+i+'" class="swal-input mr-3" id="swal-input-' + i + '" ' + checked + ' >';
        xhtml += '<label style="font-size: 12px;">' +  THEME_DATA.definePrivilege[i] + '</label></li>'
    }
    xhtml += '</ul></form>';
    
    return xhtml;
}

function swalCreateFormHTML(arrPrivilege, arrActive){
    var xhtml = '';
    xhtml = '<form id="form-privilege"><ul class="list-group-sm">';
    for (let i = 1; i <= arrPrivilege.length; i++) {
        checked = (arrActive.includes(i.toString())) ? 'checked' : '';
        xhtml += '<li class="list-group-item text-left p-1 pl-2" style="height: 30px;">';
        xhtml += '<input type="checkbox" value="'+i+'" class="swal-input mr-3" id="swal-input-' + i + '" ' + checked + ' >';
        xhtml += '<label style="font-size: 12px;">' +  THEME_DATA.definePrivilege[i] + '</label></li>'
    }
    xhtml += '</ul></form>';
    
    return xhtml;
}

function createLink(exceptParams) {
    let pathname = window.location.pathname;
    let searchParams = new URLSearchParams(window.location.search);
    let searchParamsEntries = searchParams.entries();


    let link = pathname + '?';
    for (let pair of searchParamsEntries) {

        if (exceptParams.indexOf(pair[0]) == -1) {
            link += `${pair[0]}=${pair[1]}&`;
        }
    }

    return link.slice(0, -1);
}

function resetLink() {
    let pathname = window.location.pathname;
    let searchParams = new URLSearchParams(window.location.search);
    let searchParamsEntries = searchParams.entries();


    let link = pathname + '?';
    for (let pair of searchParamsEntries) {
        if (pair[0] == 'module') link += `${pair[0]}=${pair[1]}`;
        if (pair[0] == 'controller') link += `&${pair[0]}=${pair[1]}`;
        if (pair[0] == 'action') link += `&${pair[0]}=${pair[1]}`;

    }

    return link;
}
//CHANGE AJAX STATE
changeAjaxState = function changeAjaxState(url) {
    $.ajax({
        url: url,
        type: 'POST',
        dataType: 'JSON',
        success: function (data) {
            $('td.modified-' + data.id).html(data.modified);
            $('td.' + data.name + '-' + data.id).html(data.html);
            $('td.' + data.name + '-' + data.id + '> div').notify(
                data.name + " changged!", {
                position: "top center",
                className: "success",
                autoHideDelay: 2000
            });
        }
    })
}

//TRASH ELEMENT
trash = function trash(url) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
            Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
            )
        }
    })
}




