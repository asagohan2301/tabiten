import HeaderComponent from '@/components/HeaderComponent'
import type { Metadata } from 'next'
import { Inter } from 'next/font/google'
import './globals.css'

const inter = Inter({ subsets: ['latin'] })

export const metadata: Metadata = {
  title: 'Tabiten',
  description: '地域を選択すると天気がわかるサービス Tabiten',
}

export default function RootLayout({
  children,
}: Readonly<{
  children: React.ReactNode
}>) {
  return (
    <html lang="ja">
      <body className={inter.className}>
        <HeaderComponent />
        {children}
      </body>
    </html>
  )
}
