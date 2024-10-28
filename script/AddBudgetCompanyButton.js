document.getElementById('addCompany').addEventListener('click', function() {

    // Clone the template
    let template = document.getElementById('userListTemplate').innerHTML;

    // Create a new div for the input and append the cloned template
    let newDiv = document.createElement('div');
    newDiv.classList.add('mb-3'); // Bootstrap margin bottom class
    newDiv.innerHTML = template; // Set the inner HTML to the cloned template

    // Append the new div to the input container
    document.getElementById('elementContainer').appendChild(newDiv);

     //Initialize Bootstrap Select for any select elements within the new div
    let selects = newDiv.querySelectorAll('.selectpicker'); // Adjust selector if needed
    selects.forEach(function(select) {
        $(select).selectpicker(); // Initialize each select
    });

    console.log(newDiv.innerHTML);
});