function submitNumber() {
    const originalNumber = document.querySelector('input[name="entered_value"]').value;

    if (originalNumber.length !== 4) {
        alert('Please enter a 4-digit original number.');
        return;
    }

    // Create a FormData object with the form data
    const formData = new FormData();
    formData.append('number', originalNumber);

    axios.post('/calculate', formData)
        .then(function (response) {
            // Handle the response from the server
            const calculatedValue = response.data.newNumber;
            const previousData = response.data.historyData;
            console.log(response);

            // Update the display with the calculated value
            document.getElementById('calculatedValue').textContent = 'New Number: ' + calculatedValue;

            // Update the display with the previous data
            const historyElement = document.getElementById('historyData');
            historyElement.innerHTML = 'Previous History: ' + previousData.join(', ');
        })
        .catch(function (error) {
            console.error(error);
        });
}
