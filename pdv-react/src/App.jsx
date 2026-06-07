import { BrowserRouter as Router, Routes, Route, Link } from 'react-router-dom';
import PDV from './views/PDV';
import Gerente from './views/Gerente'; // Certifique-se de que o caminho do arquivo está correto

function App() {
  return (
    <Router>
      <nav style={{ padding: '10px', borderBottom: '1px solid #00e676', display: 'flex', gap: '20px' }}>
        <Link to="/" style={{ color: '#00e676', textDecoration: 'none' }}>[ SISTEMA_PDV ]</Link>
        <Link to="/gerente" style={{ color: '#00e676', textDecoration: 'none' }}>[ PAINEL_GERENTE ]</Link>
      </nav>
      
      <Routes>
        <Route path="/" element={<PDV />} />
        <Route path="/gerente" element={<Gerente />} />
      </Routes>
    </Router>
  );
}
export default App;