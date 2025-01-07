# Daily UW: Student News Search Engine
## Overview 
This repository highlights a search engine project developed with the guidance under the Search and Recommendation Systems class taught by Professor Chirag Shah at the University of Washington. The project aimed to optimize search and recommendation functionalities using content from The Daily UW, the university's student-run newspaper.

The implemented system allows users to search articles efficiently and view trending topics based on popular queries. This project integrates concepts from search and recommendation systems, providing both a functional search interface and a "what others are searching for" recommendation section.


### Technical Details
The project is hosted on a private server at http://searchrec.ischool.uw.edu/manavag/search-final.php. (Note: The website is not publicly accessible, but a video walkthrough is included in this repository.)

### Data Collection
- The content from The Daily UW website (https://www.dailyuw.com/) was crawled using the wget command. This data was then indexed to create a searchable database. 
- Used PyTerrier for indexing and retrieval and leveraged the FilesIndexer and IndexFactory classes to structure and load data efficiently. The preprocessing retained original phrasing to preserve context in news headlines. 
- The TF-IDF model was selected for its simplicity, speed, and effectiveness in identifying relevant results. It assigns higher importance to unique terms, ensuring accurate retrieval of documents.
  

### Index Statistics:
Number of documents: 963
Number of terms: 18,691
Number of postings: 1,083,722
Number of tokens: 7,886,349


## Acknowledgments
Special thanks to Professor Chirag Shah for guiding us through the concepts of search and recommendation systems.

### Contributors
Arushi, Manav, Martin, Daphni

### Creative Commons License
https://creativecommons.org/licenses/by-nc-sa/4.0/ 

