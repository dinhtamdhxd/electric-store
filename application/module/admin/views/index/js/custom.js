$(document).ready(function() {
    $.widget.bridge('uibutton', $.ui.button);

    //CHECK ALL CHECKBOX
    $('#check-all').click(function(e) {
        var status = this.checked;
        $('#form-table').find(':checkbox').not($(this)).each(function() {
            this.checked = status;
        });
    });

    //CHANGE GROUP ACP
    $('#filter-group-acp').change(function(e) {
        let exceptParams = ['filter-group-acp'];
        let link = createLink(exceptParams) + 'filter-group-acp=' + $(this).val();
        window.location.href = link;

    })
});

function createLink(exceptParams) {
    let pathname = window.location.pathname;
    let searchParams = new URLSearchParams(window.location.search);
    let searchParamsEntries = searchParams.entries();


    let link = pathname + '?';
    for (let pair of searchParamsEntries) {
        console.log(pair[0]);
        if (exceptParams.indexOf(pair[0]) == -1) {
            link += `${pair[0]}=${pair[1]}&`;
        }
    }

    return link;
}