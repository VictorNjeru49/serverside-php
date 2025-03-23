document.addEventListener('DOMContentLoaded', function() {
fetch('data/data.json')
            .then(response => response.json())
            .then(data => {
                const galleryContainer = document.getElementById('gallery-container');

               
                data.forEach(item => {
                    const galleryItem = document.createElement('div');
                    galleryItem.classList.add('gallery-item');

                    const title = document.createElement('h2');
                    title.textContent = item.title;

                    const image = document.createElement('img');
                    image.src = item.image;
                    image.alt = item.title;

                    const description = document.createElement('p');
                    description.textContent = item.description;

                    galleryItem.appendChild(title);
                    galleryItem.appendChild(image);
                    galleryItem.appendChild(description);

                    galleryContainer.appendChild(galleryItem);
                });
            })
            .catch(error => {
                console.error('Error fetching gallery data:', error);
            });
        });