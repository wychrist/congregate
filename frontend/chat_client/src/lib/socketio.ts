import { io } from 'socket.io-client'

const chatDomain = document.querySelector('meta[name=\'cp_chat_server\']')?.getAttribute('content') || 'http://realtime.test:3000'
// const ioClient =  io(chatDomain)


export const client = io(chatDomain)
