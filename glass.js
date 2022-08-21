


$(".btnedit").click( e =>{
    let id = $("input[name*='item-id']")
// id.attr("readonly","readonly");
   console.log("button clicked again");
    let textvalues = displayData(e);

    ;
    
    let itemname = $("input[name*='item']");
    let bar = $("input[name*='bar']");
    let store = $("input[name*='store-room']");
    
    itemname.val(textvalues[2]);
    id.val(textvalues[0]);

    bar.val(textvalues[3]);
    store.val(textvalues[4]);
});



function displayData(e) {
    let iditem = 0;
    const td = $("#tbody tr td");
    let textvalues = [];

    for (const value of td){
        if(value.dataset.iditem == e.target.dataset.iditem){
           textvalues[iditem++] = value.textContent;
        }
    }
    return textvalues;

}