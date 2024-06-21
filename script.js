
// make sure dom loaded
document.addEventListener('DOMContentLoaded', () => {
    const buttons = document.querySelectorAll('.button');
    const contains  = document.querySelectorAll('.hidden');
    console.log("kontol");
    buttons.forEach(button => {
        button.addEventListener( 'click', (event) => {
            buttons.forEach( button => {
                button.classList.remove('clicked');
            });

            event.currentTarget.classList.add('clicked');

            const targetid = button.getAttribute('data-target');
            contains.forEach( contain => {
                if(contain.id === targetid){
                    contain.classList.add('show');
                } else{
                    contain.classList.remove('show');
                                }
            });
        });
        
    });


})