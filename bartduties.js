
 let idsupplies = $("input[name*='duty3-id']");
 idsupplies.attr("readonly","readonly");
 
 $(".btnedit_supplies").click( e =>{
    console.log("button clicked");
     let textvaluessupplies = displayDatasupply(e);
     let name = $("input[name*='name']");
     let item = $("input[name*='item']");
     let mobile = $("input[name*='mobile']");
     let email = $("input[name*='email']");
     idsupplies.val(textvaluessupplies[0]);
     name.val(textvaluessupplies[1]);
     item.val(textvaluessupplies[2]);
     mobile.val(textvaluessupplies[3]);
     email.val(textvaluessupplies[4]);
 });
 function displayDatasupply(e) {
     let idsupplies = -1;
     const td = $("#tbody tr td");
     let textvaluessupplies = [];
 
     for (const value of td){
         if(value.dataset.idsupplies == e.target.dataset.idsupplies){
            textvaluessupplies[idsupplies++] = value.textContent;
         }
     }
     return textvaluessupplies;
 
 }
 
let id = $("input[name*='duty-id']")
id.attr("readonly","readonly");

$(".btnedit").click( e =>{
   console.log("button clicked");
    let textvalues = displayData(e);
    let dutyname = $("input[name*='duty-name']");
    id.val(textvalues[0]);
    dutyname.val(textvalues[1]);
});
$(".btnedit_").click( e =>{
    let id = $("input[name*='duty2-id']")
    id.attr("readonly","readonly");
    let textvalues = displayData(e);
    let dutyname = $("input[name*='duty2-name']");
    id.val(textvalues[0]);
    dutyname.val(textvalues[1]);
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


