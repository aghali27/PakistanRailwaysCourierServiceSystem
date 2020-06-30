var uid;
var udm;

function getdelvalues(userid,udomain){
    uid = userid;
    udm = udomain;
}
function deluser(){
    window.location.href = "deleteaccount.php?uid="+uid+"&domain="+udm;
}