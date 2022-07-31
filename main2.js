let id = $("input[name*='recipe-id']")
id.attr("readonly","readonly");


$(".btnedit").click( e =>{
   console.log("button clicked again");
    let textvalues = displayData(e);

    ;
    
    let recipename = $("input[name*='recipe-name']");
    let stockonhand = $("input[name*='stock-on-hand']");
    let slow = $("input[name*='slow-par']");
    let busy = $("input[name*='busy-par']");

    id.val(textvalues[0]);
    slow.val(textvalues[1]);
    busy.val(textvalues[2]);
    recipename.val(textvalues[3]);
    stockonhand.val(textvalues[4]);
});
$(".read_prep").click( e =>{
    return false
});


function displayData(e) {
    let id = 0;
    const td = $("#tbody tr td");
    let textvalues = [];

    for (const value of td){
        if(value.dataset.id == e.target.dataset.id){
           textvalues[id++] = value.textContent;
        }
    }
    return textvalues;

}