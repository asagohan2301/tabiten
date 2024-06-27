'use client'

import AreaComponent from '@/components/AreaComponent'
import MessageComponent from '@/components/MessageComponent'
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
    return <MessageComponent message="Loading..." />
  }

  if (error) {
    return <MessageComponent message={`エラー: ${error}`} />
  }

  return (
    <main className="mx-auto w-2/3 pb-10">
      <p className="text-sm">都市名をクリックすると天気を表示します。</p>
      <div className="mt-3 flex flex-wrap gap-8">
        {areas.map((area) => (
          <AreaComponent key={area.id} area={area} />
        ))}
      </div>
    </main>
  )
}
