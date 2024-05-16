let page = 0

const $cardtable = $('.cardtable-select');

function ShowPage(){
    let nbElements = $cardtable.val();
    let items = $('.cardtable > .cardtable-item');
    items.hide();
    let first = page * nbElements;
    for (let i= 0; i < nbElements; i++){
        let item = $(items[first+i])
        if(item){
            item.show()
        }
    }
}

$('.page-item').on('click', function(e){
    e.preventDefault()
    let nbElements = $cardtable.val();
    let nbItems = $('.cardtable > .cardtable-item').length;
    if($(this).hasClass('next-page')){
        if(page+1 < nbItems/nbElements){
            page++;
        }
    } else if ($(this).hasClass('previous-page')){
        if(page-1 >=0){
            page--;
        }
    } else if ($(this).hasClass('page-number')){
        page = parseInt($(this).children('a').text())-1
    }
    ShowPage();
    updatePage()
})

function updatePage(){
    let nbElements = $cardtable.val();
    let nbItems = $('.cardtable > .cardtable-item').length;
    let activePage = $('.page-item.active')
    let currentPage = parseInt(activePage.children('a').text())-1
    let lastorfirst = activePage.hasClass('page-one') || activePage.hasClass('page-third')
    activePage.removeClass('active')
    if(page === 0){
        $('.page-one').addClass('active')
    }
    else if(Math.floor(nbItems/nbElements) === page){
        $('.page-third').addClass('active')
    } else {
        $('.page-two').addClass('active')
        if(page>currentPage && !lastorfirst){
            updateNumbers(1)
        } else if (page<currentPage && !lastorfirst){
            updateNumbers(-1)
        }
    }
}

function updateNumbers(number){
    let p1 = $('.page-one').children('a')
    let p2 = $('.page-two').children('a')
    let p3 = $('.page-third').children('a')
    p1.html(parseInt(p1.text())+number);
    p2.html(parseInt(p2.text())+number);
    p3.html(parseInt(p3.text())+number);
}

function resetNumbers(){
    let p1 = $('.page-one').children('a')
    let p2 = $('.page-two').children('a')
    let p3 = $('.page-third').children('a')
    p1.html(1);
    p2.html(2);
    p3.html(3);
}

function updatePageVisible(){
    if($('.page-item.active').length === 0){
        $('.page-one').click()
    }
    let nbElements = $cardtable.val();
    let nbItems = $('.cardtable > .cardtable-item').length;
    let p2 = $('.page-item .page-two')
    let p3 = $('.page-item .page-third')
    if(nbItems/nbElements > 1){
        p2.show()
    } else {
        p2.hide()
    }
    if (nbItems/nbElements > 2){
        p3.show()
    } else {
        p3.hide()
    }
    ShowPage();
}

$( document ).ready(function (){
    updatePageVisible();
})

$cardtable.on('change',function (){
    page = 0
    resetNumbers()
    updatePage()
    updatePageVisible()
})