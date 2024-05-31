function addCards(id){
    let table = document.getElementById(id)
    while (table.parentElement.childNodes.length > 1) {
        table.parentElement.removeChild(table.parentElement.lastChild);
    }
    table.classList.add('d-none')
    let tr =  table.querySelector('tbody').querySelectorAll('tr')
    tr.forEach((tr)=>{
        let name = tr.children[0].innerText;
        let desc = tr.children[1].innerText;
        let color = tr.children[2].innerText;
        let action = tr.children[3].innerHTML;
        let card = document.querySelector('.card-model').cloneNode(true)
        card.classList.remove('card-model')
        card.querySelector('.card-color').setAttribute('style','background-color:'+color)
        card.querySelector('.card-name').innerText = name;
        card.querySelector('.card-desc').innerText = desc;
        card.querySelector('.card-action').innerHTML = action;
        table.parentElement.appendChild(card);
    })
    GenerateTooltips();
}

window. addEventListener('load',() => {
    $('table.datatable').DataTable({
        language: {
            url: document.body.dataset.datatableLanguage,
        },
        stateSave: false,
        order: [[0, 'asc']],
        pageLength: 12,
        lengthMenu: [3, 6, 9, 12, 24, 36],
        pagingType: 'simple_numbers',
        initComplete: function () {
            let id = $(this).attr('id')
            addCards(id)
        },
    }).on('draw', function () {
        let id = $(this).attr('id')
        addCards(id)
    });
})