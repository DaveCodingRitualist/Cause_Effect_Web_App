sideNav.addEventListener('load', e => {
 preventDefaut();
 e.stopPropagation();
});

read = true;
if(read){
    result = 'understand' + 'agree';
    confirm = true;
    console.log(`I ${result}`);
}


