const chairs = document.querySelectorAll(".chair");
const ChairCounter = document.getElementById("totalChairs")
const ChairCheck = document.getElementById("chairCheck")
const selectedSeats = [];

chairs.forEach(chair => {
  chair.addEventListener("click", () => {
    chair.classList.toggle("selected");
    const seatInput = document.getElementById("selectedSeatsInput")
    const row = chair.dataset.row;
    const seat = chair.dataset.seat;
    const seatNumber = row + seat;
    if (!chair.classList.contains("taken")) {
      if (chair.classList.contains("selected")) {
        selectedSeats.push(seatNumber);
      } else {
        selectedSeats.splice(index, 1);
      }
    }
    seatInput.value = selectedSeats
    ChairCheck.textContent = selectedSeats
    updateDisplay()
  });
});


let CorrectTicketAmount = true;
function updateDisplay() {
  ChairCounter.textContent = selectedSeats.length

  if (ChairCounter.textContent == totalTickets.textContent) {
    ChairCounter.parentElement.style.color = "black";
    CorrectTicketAmount = true;
  } else {
    ChairCounter.parentElement.style.color = "red"; // maakt hele p rood
    CorrectTicketAmount = false
  }
}

const PriceDisplay = document.getElementById('totalPrice');
const TicketCheck = document.getElementById("ticketCheck");
const inputs = document.querySelectorAll('input[type="number"]');
const totalTicketsEl = document.getElementById('totalTickets');

function updateTotal() {
  let ticketCheckText = '';
  let total = 0;
  let totalPrice = 0; // begin elke keer op 0

  inputs.forEach(input => {
    const count = parseInt(input.value) || 0;
    total += count;

    if (input.name === "normal" && count > 0) {
      ticketCheckText += count + 'x normaal ';
      totalPrice += count * 9;
    } else if (input.name === "child" && count > 0) {
      ticketCheckText += count + 'x child ';
      totalPrice += count * 5;
    } else if (input.name === "senior" && count > 0) {
      ticketCheckText += count + 'x senior ';
      totalPrice += count * 7;
    }
  });

  TicketCheck.textContent = ticketCheckText;
  totalTicketsEl.textContent = total;
  PriceDisplay.textContent = "€" + totalPrice.toFixed(2); // mooi met 2 decimalen
  
  updateDisplay()
}

inputs.forEach(input => {
  input.addEventListener('input', updateTotal);
});



const reserveerBtn = document.getElementById("reserveer");

reserveerBtn.addEventListener("click", (e) => {
  if (!CorrectTicketAmount) {
    e.preventDefault(); // voorkomt dat de form meteen submit
    const target = document.getElementById("totalTickets"); // of welk id je wil
    target.scrollIntoView({ behavior: "smooth", block: "center" });
  }
});
