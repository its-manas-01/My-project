function rollDice() {
    fetch('/roll', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({})
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('message').innerHTML = data.message;

        let tableCells = document.querySelectorAll('td');
        tableCells.forEach(cell => {
            cell.innerHTML = cell.innerHTML.replace(/<br>.*$/, ''); // Clear previous player names
        });

        data.positions.forEach((pos, i) => {
            if (pos > 0) {
                const cell = [...tableCells].find(td => td.innerText.includes(pos.toString()));
                if (cell) {
                    cell.innerHTML += `<br>${data.currentPlayer === i ? 'Player ' + (i + 1) : ''}`;
                }
            }
        });
    })
    .catch(error => console.error('Error:', error));
}
