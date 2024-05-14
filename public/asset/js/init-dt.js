window. addEventListener('load',() => {
    $('table.datatable').DataTable({
        language: {
            url: document.body.dataset.datatableLanguage,
        },
        layout: {
            topStart: {
                buttons: ['colvis', 'pageLength']
            },
            bottomStart: 'info',
            bottomEnd: 'paging'
        },
        stateSave: true,
        pagingType: 'simple_numbers'
    })
})