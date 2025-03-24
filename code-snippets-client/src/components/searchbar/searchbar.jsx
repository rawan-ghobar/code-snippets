import React, { useState } from 'react';
import "./searchbar.css";

function SearchBar({ onSearch }) {
    const [query, setQuery] = useState('');

    const handleSubmit = async (event) => {
        event.preventDefault();
        if (query.trim()) {
            onSearch(query);
        }
    };

    const handleInputChange = (event) => {
        setQuery(event.target.value);
    };

    return (
        <form id="searchForm" className="search-form" onSubmit={handleSubmit}>
            <input
                type="text"
                name="query"
                id="searchQuery"
                placeholder="Find snippet by tag"
                required
                value={query}
                onChange={handleInputChange}
            />
            <button type="submit">Search</button>
        </form>
    );
}

export default SearchBar;
