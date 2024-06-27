'use client'

import AreaComponent from '@/components/AreaComponent'
import type { Area } from '@/types/APIDataTypes'
import { useEffect, useState } from 'react'

export default function Home() {
  const [areas, setAreas] = useState<Area[]>([])
  const [loading, setLoading] = useState(true)
  const [error, setError] = useState<string | null>(null)

  useEffect(() => {
    fetch(`${process.env.NEXT_PUBLIC_API_ENDPOINT}/api/cities`)
      .then((res) => {
        if (!res.ok) {
          throw new Error('地域情報の取得に失敗しました')
        }
        return res.json()
      })
      .then((resData) => {
        setAreas(resData)
        setLoading(false)
      })
      .catch((err) => {
        setError(err.message)
        setLoading(false)
      })
  }, [])

  if (loading) {
    return <p>Loading...</p>
  }

  if (error) {
    return <p>エラー: {error}</p>
  }

  return (
    <main>
      {areas.map((area) => (
        <AreaComponent key={area.id} area={area} />
      ))}
    </main>
  )
}
