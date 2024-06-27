export default function MessageComponent({ message }: { message: string }) {
  return (
    <div className="flex h-screen items-center justify-center">
      <p>{message}</p>
    </div>
  )
}
