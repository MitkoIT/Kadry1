document.getElementById('addCompany').addEventListener('click', function() {
    
    // Clone the template
    var template = document.getElementById('firmListTemplate').innerHTML;

    // Create a new div for the input and append the cloned template
    var newDiv = document.createElement('div');
    newDiv.classList.add('mb-3'); // Bootstrap margin bottom class
    newDiv.innerHTML = template; // Set the inner HTML to the cloned template


    console.log(newDiv.innerHTML);

    // Append the new div to the input container
    document.getElementById('elementContainer').appendChild(newDiv);
   
});