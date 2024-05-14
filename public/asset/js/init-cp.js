window. addEventListener('load',() => {
    $('.cpicker').colorpicker()
    $('.cpicker input').on('change', ()=>{

        $('.cpicker').find('.fa-square').css('color', $('.cpicker input').val())
    })
})