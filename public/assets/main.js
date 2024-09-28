/*
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
*/

let searchButton = document.getElementById("searchButton");

searchButton.addEventListener("click", async () => {
    console.log('searchButton clicked');

    try {

        let searchResultContainer = document.getElementById("searchResultContainer");
        let html = "<div class='card-group justify-content-center'>";
        let searchInput = document.getElementById("searchInput").value;

        const res = await fetch("http://school.test/public/api/users", {
            method: "POST",
            body: JSON.stringify({"search_input": searchInput}),
            headers: {
                "Content-Type": "application/json"
            }
        });

        const output = await res.json();
        console.log(output);
        /*
        

        const output = await res.json();
        */
        for(var i in output)
        {
            html +=`
            <div class="card m-2 user-card" style="max-width: 14rem;min-width: 13rem;">
                <img src="http://school.test/public/assets/user_male.jpg" class="card-img-top d-block mx-auto" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">${output[i].firstname} ${output[i].lastname}</h5>
                    <p class="card-text">${output[i].user_rank}</p>
                    <a href="http://school.test/public/profile/${output[i].user_id}" class="btn btn-primary">Profile</a>
                    <button type="submit" name="selected" class="btn btn-danger float-end">Select</button>
                </div>
            </div>`;
        }
        html += "</div>";
        console.log(html);
        searchResultContainer.innerHTML = html;
        
    } catch (error) {
        console.log("error" + error);
    }
});