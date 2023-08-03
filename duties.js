let id = $("input[name*='duty-id']")
id.attr("readonly","readonly");


$(".btnedit").click( e =>{
   console.log("button clicked");
    let textvalues = displayData(e);
    let dutyname = $("input[name*='duty-name']");
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
