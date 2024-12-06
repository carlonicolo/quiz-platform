// Handle form validation for required fields
document.addEventListener("DOMContentLoaded", function () {
    const forms = document.querySelectorAll("form");

    forms.forEach((form) => {
        form.addEventListener("submit", function (event) {
            let isValid = true;
            const requiredFields = form.querySelectorAll("[required]");

            requiredFields.forEach((field) => {
                if (!field.value.trim()) {
                    field.style.borderColor = "red";
                    isValid = false;
                } else {
                    field.style.borderColor = "#ddd";
                }
            });

            if (!isValid) {
                event.preventDefault();
                alert("Please fill out all required fields.");
            }
        });
    });
});

// Confirmation before deleting a topic or question
function confirmDelete() {
    return confirm("Are you sure you want to delete this item?");
}

// Dynamically update subcategories based on selected topic
function loadSubcategories(topicId, subcategorySelectId) {
    fetch(`api/getSubcategories.php?topic_id=${topicId}`)
        .then((response) => response.json())
        .then((data) => {
            const subcategorySelect = document.getElementById(subcategorySelectId);
            subcategorySelect.innerHTML = "<option value=''>Select Subcategory</option>";

            data.forEach((subcategory) => {
                const option = document.createElement("option");
                option.value = subcategory.id;
                option.textContent = subcategory.name;
                subcategorySelect.appendChild(option);
            });
        })
        .catch((error) => console.error("Error loading subcategories:", error));
}
