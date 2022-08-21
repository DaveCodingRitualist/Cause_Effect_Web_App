let id = $("input[name*='item-id']")
id.attr("readonly","readonly");


$(".btnedit").click( e =>{
   console.log("button clicked again");
    let textvalues = displayData(e);

    ;
    
    let item = $("input[name*='item']");
    let request = $("input[name*='request']");
    let soh = $("input[name*='soh']");
    let issued = $("input[name*='issued']");


   item.val(textvalues[1])
    id.val(textvalues[0]);
 ;
    request.val(textvalues[2]);
    issued.val(textvalues[3]);
    soh.val(textvalues[4]);

    
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