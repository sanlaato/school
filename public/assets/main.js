var userCards = document.getElementsByClassName("user-card");
if(userCards.length > 0)
{
    var exampleModal = document.getElementById("exampleModal")
    if(exampleModal != null)
    {
        var myModal = new bootstrap.Modal(exampleModal, {});
        document.onreadystatechange = function () {
            myModal.show();
        };
    }
}
