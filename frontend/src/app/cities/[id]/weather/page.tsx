'use client'

import type { Weathers } from '@/types/APIDataTypes'
import type { Params } from 'next/dist/shared/lib/router/utils/route-matcher'
import { useEffect, useState } from 'react'

export default function Weather({ params }: { params: Params }) {
  const [weathers, setWeathers] = useState<Weathers | null>(null)
  const [loading, setLoading] = useState(true)
  const [error, setError] = useState<string | null>(null)

  useEffect(() => {
    fetch(
      `${process.env.NEXT_PUBLIC_API_ENDPOINT}/api/cities/${params.id}/weather`,
    )
      .then((res) => {
        if (!res.ok) {
          throw new Error('天気情報の取得に失敗しました')
        }
        return res.json()
      })
      .then((resData) => {
        setWeathers(resData)
        setLoading(false)
      })
      .catch((err) => {
        setError(err.message)
        setLoading(false)
      })
  }, [params.id])

  if (loading) {
    return <p>Loading...</p>
  }

  if (error) {
    return <p>エラー: {error}</p>
  }

  return (
    <main>
      {weathers &&
        weathers.date.map((date, index) => (
          <div key={index}>
            <h2>{date}</h2>
            <p>{weathers.category[index]}</p>
            <p>{weathers.description[index]}</p>
            <p>{weathers.temp_max[index]}°C</p>
            <p>{weathers.temp_min[index]}°C</p>
            <p>{weathers.precipitation_probability[index]}%</p>
          </div>
        ))}
    </main>
  )
}
