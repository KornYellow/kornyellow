<?php

namespace libraries\kornyellow\components;

use libraries\kornyellow\enums\EnumTransactionType;
use libraries\kornyellow\instances\methods\transaction\KYTransaction;

class KYTransactionHistory {
	/**
	 * @param KYTransaction[] $transactions
	 *
	 * @return string
	 */
	public static function getHistoryBars(array|null $transactions): string {
		$transactionsDisplay = '';
		foreach ($transactions as $transaction) {
			$category = $transaction->getTransactionCategory();
			$categoryNote = '';
			if (!is_null($category))
				$categoryNote = !is_null($transaction->getTransactionCategory()->getNote()) ? ' ('.$category->getNote().')' : '';
			$category = !is_null($category) ? $category->getName() : 'อื่น ๆ';

			$amountColor = $transaction->getTransactionType()->compareTo(EnumTransactionType::OUTCOME()) ? 'text-yellow' : 'text-light';
			$amount = ($transaction->getTransactionType()->compareTo(EnumTransactionType::OUTCOME()) ? '-' : '+').' '.number_format($transaction->getAmount(), 2);

			$transactionsDisplay .= KYTransactionHistory::historyBar(
				$transaction->getID(),
				$transaction->getName(),
				$transaction->getNote(),
				$amountColor,
				$amount,
				$transaction->getDateTime()->toStringTime(),
				$category.$categoryNote,
			);
		}
		return $transactionsDisplay;
	}
	private static function historyBar(int $id, string $name, string|null $note, string $amountColor, string $amount, string $date, string $category): string {
		if ($note != null)
			$note = '
				<div class="col-12 col-sm-12 text-slate-300">
					<i class="fa-solid fa-note-sticky fa-fw me-2"></i>'.$note.'	
				</div>
			';
		else
			$note = '';
		return '
            <div class="col-12">
                <div class="bg-slate-700 rounded-3 px-2 px-sm-3 py-2">
                    <div class="d-flex justify-content-between gap-1 gap-sm-2">
                        <div class="flex-grow-1 overflow-hidden">
							<div class="d-flex text-muted justify-content-between align-items-center">
                                <div class="text-slate-400 me-3 text-truncate">'.$category.'</div>
								<div class="text-slate-400">'.$date.'</div>
							</div>
							<div class="d-flex fw-semibold justify-content-between align-items-center fs-5 my-n1">
								<div class="text-truncate fw-semibold me-3 fw-semibold">'.$name.'</div>
								<div class="text-nowrap '.$amountColor.'">'.$amount.'</div>
							</div>
						</div>
						<div>
							<div class="dropdown h-100 text-end">
								<button class="btn btn-grey-icon dropdown-toggle" title="จัดการเพิ่มเติม" type="button" data-bs-toggle="dropdown">
									<i class="fa-solid fa-ellipsis-vertical fa-xl px-sm-2 p-0"></i>
								</button>
								<ul class="dropdown-menu dropdown-menu-end">
									<li>
										<a class="dropdown-item fw-semibold" href="/finances/edit?id='.$id.'">
											<i class="fa-solid fa-pen-to-square fa-fw me-2"></i>
											<span class="fw-semibold">แก้ไข</span>
										</a>
									</li>
									<li>
										<a class="dropdown-item fw-semibold" href="/finances/delete?id='.$id.'">
											<i class="fa-solid fa-trash-can fa-fw me-2 text-yellow"></i>
											<span class="fw-semibold text-yellow">ลบ</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					'.$note.'
                </div>
            </div>
		';
	}
	public static function historyEmpty(): string {
		return '
			<div class="col-12">
				<div class="bg-slate-700 rounded-3 px-2 px-sm-3 py-2 text-slate-300 text-nowrap fw-semibold text-center">
					<i class="fa-solid fa-exclamation fa-fw me-2"></i>ยังไม่พบข้อมูลที่ท่านต้องการ
				</div>
			</div>
		';
	}
}