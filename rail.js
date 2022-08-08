let id = $("input[name*='item-id']")
id.attr("readonly","readonly");


$(".btnedit").click( e =>{
   console.log("button clicked again");
    let textvalues = displayData(e);

    ;
    
    let itemname = $("input[name*='item-name']");
    let monday = $("input[name*='monday']");
    let tuesday = $("input[name*='tuesday']");
    let wednesday = $("input[name*='wednesday']");
    let thursday = $("input[name*='thursday']");
    let friday = $("input[name*='friday']");
    let saturday = $("input[name*='saturday']");
    let sunday= $("input[name*='sunday']");
    
    

    id.val(textvalues[0]);
    itemname.val(textvalues[1]);
    monday.val(textvalues[2]);
    tuesday.val(textvalues[3]);
    wednesday.val(textvalues[4]);
    thursday.val(textvalues[5]);
    friday.val(textvalues[6]);
    saturday.val(textvalues[7]);
    sunday.val(textvalues[8]);
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