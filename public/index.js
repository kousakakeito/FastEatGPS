window.addEventListener('load', function() {
  fetch('/api/find-restaurants', {
      method: 'POST',
      headers: {
          'Content-Type': 'application/json',
      },
      body: JSON.stringify({

      })
  })
  .then(response => response.json())
  .then(data => {
      const listElement = document.querySelector('.restaurant-list');
      data.forEach(restaurant => {
          const listItem = document.createElement('li');
          listItem.textContent = `${restaurant.name} - ${restaurant.distance}`;
          listElement.append(listItem);
      });
  })
  .catch(error => console.error('Error:', error));
});