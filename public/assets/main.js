let searchButton = document.getElementById("searchButton");
let classId = document.getElementById("classId").value;
var exampleModal = new bootstrap.Modal(document.getElementById('exampleModal'), {
    keyboard: false
});


async function listAllLecturers()
{
    try {
        let lecturersContainer = document.getElementById("lecturersContainer");
        let html = "<div class='card-group justify-content-center'>";
        let searchInput = "uzumaki";

        const res = await fetch("http://school.test/public/api/classes/list_all_lecturers", {
            method: "POST",
            body: JSON.stringify({"class_id": classId}),
            headers: {
                "Content-Type": "application/json"
            }
        });

        const output = await res.json();

        for(var i in output)
        {
            html +=`
            <div class="card m-2 user-card" style="max-width: 14rem;min-width: 13rem;">
                <img src="http://school.test/public/assets/user_male.jpg" class="card-img-top d-block mx-auto" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">${output[i].user.firstname} ${output[i].user.lastname}</h5>
                    <p class="card-text">${output[i].user.user_rank}</p>
                    <a href="http://school.test/public/profile/${output[i].user.user_id}" class="btn btn-primary">Profile</a>

                </div>
            </div>`;
        }
        html += "</div>";
        lecturersContainer.innerHTML = html;
    } catch (error) {
        console.log("error" + error);
    }
}

window.onload = async (event) => {
    listAllLecturers();
};

searchButton.addEventListener("click", async () => {
    try {

        let searchResultContainer = document.getElementById("searchResultContainer");
        let html = "<div class='card-group justify-content-center'>";
        let searchInput = document.getElementById("searchInput").value;

        const res = await fetch("http://school.test/public/api/classes/search_lecturers", {
            method: "POST",
            body: JSON.stringify({"search_input": searchInput, "class_id": classId}),
            headers: {
                "Content-Type": "application/json"
            }
        });

        const output = await res.json();

        for(var i in output)
        {
            html +=`
            <div class="card m-2 user-card" style="max-width: 14rem;min-width: 13rem;">
                <img src="http://school.test/public/assets/user_male.jpg" class="card-img-top d-block mx-auto" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">${output[i].firstname} ${output[i].lastname}</h5>
                    <p class="card-text">${output[i].user_rank}</p>
                    <a href="http://school.test/public/profile/${output[i].user_id}" class="btn btn-primary">Profile</a>`;

            if(output[i].added) {
                html += `<button value="${output[i].user_id}" type="submit" name="selected" disabled class="select-button btn btn-secondary float-end">Added</button>`;
            } else {
                html += `<button value="${output[i].user_id}" type="submit" name="selected" class="select-button btn btn-danger float-end">Select</button>`;
            }

            html += `</div></div>`;
        }
        html += "</div>";
        searchResultContainer.innerHTML = html;

        var selectButtons = document.getElementsByClassName("select-button");

        [...selectButtons].forEach(function(button, index){
            button.addEventListener('click', async () => {
                const res = await fetch("http://school.test/public/api/classes/add_lecturer", {
                    method: "POST",
                    body: JSON.stringify({"class_id": classId, "user_id": button.value}),
                    headers: {
                        "Content-Type": "application/json"
                    }
                });

                const output = await res.json();
                
                exampleModal.hide();

                searchResultContainer.innerHTML = "";

                listAllLecturers();
            });
        });
        
    } catch (error) {
        console.log("error" + error);
    }
});