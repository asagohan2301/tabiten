'use client'

import MessageComponent from '@/components/MessageComponent'
import WeatherIconComponent from '@/components/WeatherIconComponent'
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

  const getDayOfWeek = (dateString: string) => {
    const daysOfWeek = ['日', '月', '火', '水', '木', '金', '土']
    const date = new Date(dateString)
    return daysOfWeek[date.getDay()]
  }

  if (loading) {
    return <MessageComponent message="Loading..." />
  }

  if (error) {
    return <MessageComponent message={`エラー: ${error}`} />
  }

  return (
    <main className="mx-auto w-1/2">
      <h2>都市名</h2>
      <div className="mt-6 flex flex-wrap">
        {weathers &&
          weathers.date.map((date, index) => (
            <div
              key={index}
              className="flex flex-1 flex-col items-center gap-8"
            >
              <div className="flex items-center">
                <h3 className="text-xl">{date.slice(-2)}</h3>
                <p className="ml-[2px] text-[15px]">({getDayOfWeek(date)})</p>
              </div>
              <div className="flex items-center justify-center">
                <WeatherIconComponent
                  category={`${weathers.category[index]}`}
                />
              </div>
              <div className="flex flex-col items-center">
                <div className="flex gap-1">
                  <p className="text-[#F9643B]">
                    {Math.floor(weathers.temp_max[index])}
                  </p>
                  <p>/</p>
                  <p className="text-[#2681FF]">
                    {Math.floor(weathers.temp_min[index])}
                  </p>
                </div>
                <p>
                  {weathers.precipitation_probability[index]}
                  <span className="ml-px text-sm">%</span>
                </p>
              </div>
            </div>
          ))}
      </div>
    </main>
  )
}
