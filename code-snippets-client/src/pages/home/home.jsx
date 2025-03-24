import React, { useEffect, useState } from 'react';
import api from '../../services/api';
import SearchBar from '../../components/searchbar/searchbar';
import NavBar from '../../components/navbar/navbar';
import './home.css';

function Home() {
    const [snippets, setSnippets] = useState([]);
    const [error, setError] = useState('');

    const fetchSnippets = async (language = null, tags = null) => {
        try {
            const count = 10;
            const page = 1;

            let url = `api/v0.1/user/snippets/${count}/${page}`;

            if (language) url += `/${language}`;
            if (tags) url += `/${tags}`;

            const response = await api.get(url);
            if (response.data.success) {
                setSnippets(response.data.data.data);
            } else {
                setError("Failed to fetch snippets.");
            }
        } catch (error) {
            console.error('Error fetching snippets:', error);
            setError('Error fetching snippets.');
        }
    };

    useEffect(() => {
        fetchSnippets();
    }, []);

    const handleSearch = (searchQuery) => {
        fetchSnippets(searchQuery.language, searchQuery.tags);
    };

    const handleAdd = async () => {
        try {
            const newSnippet = {
                title: 'New Snippet Title',
                content: 'New snippet content...',
                tags: ['example']
            };

            const response = await api.post('api/v0.1/user/addOrUpdatesnipet/add', newSnippet);
            if (response.data.success) {
                fetchSnippets();
            } else {
                setError("Failed to add snippet.");
            }
        } catch (err) {
            console.error('Error adding snippet:', err);
            setError('Error adding snippet.');
        }
    }

    return (
        <div>
            <NavBar/>
            <div className="home">
            <h1>Code Snippets</h1>
            <div className="search-add-container">
                <SearchBar onSearch={handleSearch} />
                <button className="add-button" onClick={handleAdd}>Add</button>
            </div>
            {error && <p>{error}</p>}
            <div className="snippet-container">
                {snippets.map(snippet => (
                    <div key={snippet.id} className="snippet-box">
                        <h3 className="snippet-title">{snippet.title}</h3>
                        <p className="snippet-content">{snippet.content}</p>
                        <p className="snippet-content">{snippet.tags.join(', ')}</p>
                    </div>
                ))}
            </div>
            </div>
        </div>
    );
}

export default Home;
