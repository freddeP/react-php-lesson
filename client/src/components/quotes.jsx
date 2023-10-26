function Quotes({quotes}) {
    return ( 


        <div>
            <pre>
                {JSON.stringify(quotes.reverse(),null, 2)}
            </pre>
        </div>

     );
}

export default Quotes;