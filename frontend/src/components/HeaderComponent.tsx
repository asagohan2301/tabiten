import { Rainbow } from 'react-bootstrap-icons'

export default function HeaderComponent() {
  return (
    <a href="/">
      <div className="mb-10 flex items-center gap-1 px-4 py-2">
        <h1 className="text-2xl">TabiTen</h1>
        <Rainbow color="#BCBCBC" size={28} />
      </div>
    </a>
  )
}
