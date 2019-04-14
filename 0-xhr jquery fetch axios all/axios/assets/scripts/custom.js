document.addEventListener("DOMContentLoaded", function(event) {
  // console.log("DOM Loaded");
  processForm();
});

window.addEventListener("load", function(event) {
  // console.log("Window loaded");
});

const form = document.querySelector('#search-form');
const searchField = document.querySelector('#search-keyword');
let searchedForText;
const responseContainer = document.querySelector('#response-container');
const responseContainerArticles  = document.querySelector('#response-container-articles');

function processForm(){
 
  form.addEventListener('submit', function(e){
    e.preventDefault();

    searchedForText = searchField.value;
    responseContainer.innerHTML = '';
    responseContainerArticles.innerHTML = '';






    axios.get(`https://api.unsplash.com/search/photos?page=1&query=${searchedForText}`, {
      headers: {
        Authorization: 'Client-ID 26810b153856944bdaa0c30e4a8bb4c390245f08858cbcb0ecf0520f43bdd5aa'
        }
      //contentType: 'text/plain',
      // contentType: 'application/json; charset=utf-8'
    })
    //.then(response)
    .then(addImage);
    //.catch(err => requestError(err, 'image'));







    axios.get(`https://api.nytimes.com/svc/search/v2/articlesearch.json?q=${searchedForText}&api-key=1gyex66s6tXxYUDLwwFSA5oh5A0ALN7u`, {
      //contentType: 'text/plain',
      // contentType: 'application/json; charset=utf-8',
    })
    //.then(response)
    .then(addArticles);
    //.catch(err => requestError(err, 'articles'));





    
  });
}





function addImage(response){
  let htmlContent = '';
  searchedForText = searchField.value;
  responseContainer.innerHTML = '';
  
  const firstImage = response.data.results[0];
  
  // console.log(firstImage);
  // console.log("image Results ///// ", firstImage.urls.small);
  
  if (firstImage) {
    htmlContent = `
    <div><img src="${firstImage.urls.regular}"</div>
    <div>${searchedForText} by ${firstImage.user.name}</div>
    `
  } else {
    htmlContent = `Sorry, no images available for '<strong>${searchedForText}</strong>'`;
  }
  responseContainer.insertAdjacentHTML('afterbegin', htmlContent);
}





function addArticles(response){
  let htmlContent = '';
  searchedForText = searchField.value;
  responseContainerArticles.innerHTML = '';

  // console.log("Article Results ///// ", response.data.response);
  
  if (response.data.response && response.data.response.docs && response.data.response.docs.length > 1) {
    htmlContent = `<div>Articles from Keyword ${searchedForText}</div><br>` + 
    '<ul>' + response.data.response.docs.map(article => 
      `<li>
        <h4><a href="${article.web_url}">${article.headline.main}</a></h4>
        <p>${article.snippet}</p>
      </li>`
      ).join('') + '</ul>';
  } else {
    htmlContent = `Sorry, no articles available for '<strong>${searchedForText}</strong>'`;
  }
  responseContainerArticles.insertAdjacentHTML('afterbegin', htmlContent);
}

