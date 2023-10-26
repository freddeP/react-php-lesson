function CreateQuote({setQuotes}) {
    

    async function handleSubmit(ev){
        ev.preventDefault();
        // Fixa data i url-encoded format
        let data = new FormData(ev.target);

        let response = await fetch("./quotes",{
            method:"POST",
            body:data,
            credentials:"include"
        });
        
        let quote = await response.json();

        setQuotes(prev=>[...prev, quote]);

        console.log(quote);


    }
    
    
    return ( 
        <div>
            <form onSubmit={handleSubmit} action="./quotes" method="post">

                <input type="text" name="title" placeholder="Title" />
                <input type="text" name="body" placeholder="Body" />
                <input type="submit" value = "Create" />

            </form>
        </div>


     );
}

export default CreateQuote;