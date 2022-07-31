let idsupplies = $("input[name*='duty3-id']");
idsupplies.attr("readonly","readonly");


$(".btnedit_supplies").click( e =>{
   console.log("button clicked");
    let textvaluessupplies = displayDatasupply(e);
    let id = $("input[name*='duty3-id']");
    let name = $("input[name*='name']");
    let item = $("input[name*='item']");
    let mobile = $("input[name*='mobile']");
    let email = $("input[name*='email']");
    id.val(textvaluessupplies[0]);
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


let id = $("input[name*='duty4-id']")
id.attr("readonly","readonly");

$(".btnedit").click( e =>{
   console.log("button clicked");
    let textvalues = displayData(e);
    let dutyname = $("input[name*='duty4-name']");
    id.val(textvalues[0]);
    dutyname.val(textvalues[1]);
});
$(".btnedit_").click( e =>{
    let id = $("input[name*='duty22-id']")
    id.attr("readonly","readonly");
    let textvalues = displayData(e);
    let dutyname = $("input[name*='duty22-name']");
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

$('#exampleModal').modal({
    backdrop: 'static',
    keyboard: false
})

document.querySelector('.read').addEventListener('click', function(event) {
    event.preventDefault();
    event.stopPropagation();
  });
