$(document).ready(function () {
    var table = $('#law-firms-table').DataTable({
        processing: true,
        serverSide: false,
        ajax: dataRoute,
        order: [[0, 'asc']],
        language: {
            emptyTable: 'Currently there are 0 law firms registered to the site.',
            lengthMenu: 'Display _MENU_ law firms per page',
            info: 'Showing _START_ to _END_ of _TOTAL_ law firms',
            infoEmpty: 'Showing 0 to 0 of 0 law firms',
            infoFiltered: '(filtered from _MAX_ total law firms)',
            loadingRecords: 'Loading law firms...',
            processing: 'Loading law firms...',
            zeroRecords: 'No matching law firms found'
        },
        columns: [
            {
                data: 'name',
                name: 'name'
            }
        ]
    });
});
