let id = $("input[name*='item-id']")
id.attr("readonly","readonly");


$(".btnedit").click( e =>{
   console.log("button clicked");
    let textvalues = displayData(e);

    ;
    
    let itemname = $("input[name*='item-name']");
    let tobuy = $("input[name*='to-buy']");
  

    id.val(textvalues[0]);
    itemname.val(textvalues[1]);
    tobuy.val(textvalues[2]);
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
$(".read").click(function(event){
    event.preventDefault();
  });

  $(document).ready(function(){
    $('#title').focus();
      $('#text').autosize();
  });