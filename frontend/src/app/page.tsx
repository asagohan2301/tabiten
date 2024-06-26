'use client'

export default function Home() {
  const getData = () => {
    fetch(`${process.env.NEXT_PUBLIC_API_ENDPOINT}/api/weather`)
      .then((res) => {
        return res.json()
      })
      .then((resData) => {
        console.log(resData)
      })
  }

  return (
    <main>
      <button onClick={getData}>get</button>
    </main>
  )
}
