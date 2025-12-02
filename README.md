# SecretSanta
 
## sql database used 
### to create same database structure use this query

CREATE TABLE data_links (
    id INT AUTO_INCREMENT PRIMARY KEY,
    link VARCHAR(255) UNIQUE NOT NULL,
    data TEXT NOT NULL,
    returned_names TEXT DEFAULT '[]', -- Names already assigned
    match_results TEXT DEFAULT '[]'   -- Stores {player: assigned_name} pairs
);

## project demo can be found here 
[Here](http://santa.ct.ws/) 


## used infinty free for hosting 
[InfinityFree](https://www.infinityfree.com/)
