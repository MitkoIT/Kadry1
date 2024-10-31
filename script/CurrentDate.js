// Get the current date
const currentDate = new Date();

// Format the date to a readable string
const options = { year: 'numeric', month: 'long', day: 'numeric' };
const formattedDate = currentDate.toLocaleDateString(undefined, options);

// Display the date in the paragraph with id "date"
document.getElementById('date').innerText = formattedDate;